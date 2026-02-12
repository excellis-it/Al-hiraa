## Add Job Create URL Helper Route

Add this route to `routes/web.php` after line 185:

```php
Route::get('/get-job-create-url/{id}', [ScheduleController::class, 'getJobCreateUrl'])->name('get-job-create-url');
```

And add this method to `ScheduleController.php`:

```php
public function getJobCreateUrl($id)
{
    $encryptedId = Crypt::encrypt($id);
    return response()->json([
        'url' => route('schedule-to-do.job-create', $encryptedId)
    ]);
}
```
