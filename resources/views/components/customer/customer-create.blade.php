<div class="modal" id="create-customer-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
            </div>
            <div class="modal-body">
                <form id="create-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerName">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmail">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobile">
                                <label class="form-label">Customer Address *</label>
                                <input type="text" class="form-control" id="customerAddress">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="create()" id="save-btn" class="btn btn-sm  btn-success">Create</button>
            </div>
        </div>
    </div>
</div>

<script>
async function create() {

    let customerName = document.getElementById('customerName').value;
    let customerEmail = document.getElementById('customerEmail').value;
    let customerMobile = document.getElementById('customerMobile').value;
    let customerAddress = document.getElementById('customerAddress').value;

    if (customerName.length === 0) {
        errorToast("customerName Required !")
    } else if (customerEmail.length === 0) {
        errorToast("customerEmail Required !")
    } else if (customerMobile.length === 0) {
        errorToast("customerMobile Required !")
    } else if (customerAddress.length === 0) {
        errorToast("customerAddress Required !")
    } else {

        document.getElementById('modal-close').click();

        showLoader();
        let res = await axios.post("/create-customer", {
            name: customerName,
            email: customerEmail,
            mobile: customerMobile,
            address: customerAddress
        })
        hideLoader();

        if (res.status === 201) {

            successToast('Request completed');

            document.getElementById("create-form").reset();

            await getList();
        } else {
            errorToast("Request fail !")
        }
    }
}
</script>