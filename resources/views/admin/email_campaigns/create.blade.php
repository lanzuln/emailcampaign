<!-- resources/views/email_campaigns/create.blade.php -->



<h2>Create Promotional Email Campaign</h2>

<div>
    <form id="emailCampaignForm">
        @csrf
        <label for="template_id">Select Template:</label>
        <select name="template_id" required>
            @foreach ($templates as $template)
            <option value="{{ $template->id }}">{{ $template->name }}</option>
            @endforeach
        </select>

        <label for="content">Customize Content:</label>
        <textarea name="content" required></textarea>

        <label for="selected_customers">Select Target Customers:</label>
        <select name="selected_customers[]" multiple required>
            @foreach ($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>

        <button type="submit">Create Campaign</button>
    </form>
</div>
<script>
document.getElementById('emailCampaignForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    axios.post('/admin/email-campaigns', formData)
        .then(response => {
            alert(response.data.message);
            // Handle success response as needed (e.g., display success message, reload the page, etc.)
        })
        .catch(error => {
            console.error(error);
            // Handle error response as needed (e.g., display error message, log errors, etc.)
        });
});
</script>