<?php

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

it('posts a ticket to api/tickets with an image', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('attachment.jpg');

    $data = [
        'name' => 'Test User',
        'email' => 'user@example.com',
        'phone' => '+1234567890',
        'subject' => 'Test subject',
        'text' => 'This is a test ticket.',
        'file' => $file,
    ];

    $response = $this->post('api/tickets', $data);

    $response->assertStatus(204);

    $ticket = \App\Models\Ticket::first();

    $this->assertDatabaseHas('media', [
        'model_type' => \App\Models\Ticket::class,
        'model_id' => $ticket->id,
        'collection_name' => 'attachments',
    ]);

    $media = Media::where('model_id', $ticket->id)->first();

    Storage::disk('public')->assertExists($media->id.'/'.$media->file_name);
});
