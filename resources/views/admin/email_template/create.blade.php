<!-- resources/views/admin/email_templates/create.blade.php -->

<form method="post" action="{{ route('email_templates.store') }}">
    @csrf
    <label for="name">Template Name:</label>
    <input type="text" name="name" required>

    <label for="content">Template Content:</label>
    <textarea name="content" required></textarea>

    <button type="submit">Create Template</button>
</form>