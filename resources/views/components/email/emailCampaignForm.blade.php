<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <h3>Promotional Email campaign</h3>
            <br>
            <form id="sendEmailForm">
                <label for="subject">Subject:</label>
                <input class="form-control" type="text" id="subject" name="subject" required>

                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                <br>
                <button class="btn" type="button" onclick="sendEmail()">Send Email</button>
            </form>

        </div>
    </div>
</div>



<script>
async function sendEmail() {
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;

    // Create an object with the data to send
    const data = {
        subject: subject,
        message: message,
    };

    showLoader();
    try {
        const res = await axios.post('/send-email', data);
        hideLoader();

        if (res.data.message === 'Welcome emails sent successfully') {
            successToast("Request success !");
        } else {
            errorToast("Request failed !");
        }
    } catch (error) {
        console.error(error);
        hideLoader();
        errorToast("An error occurred during the request!");
    }
}
</script>