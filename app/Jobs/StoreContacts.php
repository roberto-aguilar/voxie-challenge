<?php

namespace App\Jobs;

use App\Contact;
use App\ContactFile;
use App\Events\ContactsStored;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;

class StoreContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\ContactFile
     */
    protected $contactFile;

    /**
     * Create a new job instance.
     *
     * @param  \App\ContactFile  $contactFile
     */
    public function __construct(ContactFile $contactFile)
    {
        $this->contactFile = $contactFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attributes = $this->getNonCustomAttributes();
        $customAttributes = $this->getCustomAttributes();

        Collection::make($this->contactFile->csv_records)->each(function ($record) use ($customAttributes, $attributes) {
            $contact = Contact::create(
                $attributes->mapWithKeys(function ($value, $key) use ($record) {
                    return [
                        $key => $record[$value],
                    ];
                })->toArray()
            );

            $customAttributes->each(function ($key) use ($contact, $record) {
                $contact->customAttributes()->create([
                    'key' => $key,
                    'value' => $record[$key],
                ]);
            });
        });

        $this->contactFile->markAsProcessed();

        Event::dispatch(new ContactsStored($this->contactFile));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getNonCustomAttributes(): Collection
    {
        return Collection::make($this->contactFile->field_mappings)->filter(function ($item) {
            return $item !== 'custom_attribute';
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getCustomAttributes(): Collection
    {
        return Collection::make($this->contactFile->field_mappings)->filter(function ($item) {
            return $item === 'custom_attribute';
        })->keys();
    }
}
