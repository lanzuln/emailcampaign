<div class="modal" id="customer-update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">
                                <label class="form-label">Customer Address *</label>
                                <input type="text" class="form-control" id="customerAddressUpdate">
                                <input type="text" class="d-none" id="updateCustomerID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
async function FillUpUpdateForm(id) {
    document.getElementById('updateCustomerID').value = id;
    showLoader();
    let res = await axios.post("/customer-by-id", {
        id: id
    })
    hideLoader();
    document.getElementById('customerNameUpdate').value = res.data['name'];
    document.getElementById('customerEmailUpdate').value = res.data['email'];
    document.getElementById('customerMobileUpdate').value = res.data['mobile'];
    document.getElementById('customerAddressUpdate').value = res.data['address'];
}


async function Update() {

    let customerNameUpdate = document.getElementById('customerNameUpdate').value;
    let customerEmailUpdate = document.getElementById('customerEmailUpdate').value;
    let customerMobileUpdate = document.getElementById('customerMobileUpdate').value;
    let customerAddressUpdate = document.getElementById('customerAddressUpdate').value;
    let updateID = document.getElementById('updateCustomerID').value;

    if (customerNameUpdate.length === 0) {
        errorToast("customer Required !")
    } else if (customerEmailUpdate.length === 0) {
        errorToast("customer Required !")
    } else if (customerMobileUpdate.length === 0) {
        errorToast("customer Required !")
    } else if (customerAddressUpdate.length === 0) {
        errorToast("customer Required !")
    } else {
        document.getElementById('update-modal-close').click();
        showLoader();
        let res = await axios.post("/update-customer", {
            name: customerNameUpdate,
            email: customerEmailUpdate,
            mobile: customerMobileUpdate,
            address: customerAddressUpdate,
            id: updateID
        })
        hideLoader();

        if (res.status === 200 && res.data === 1) {
            document.getElementById("update-form").reset();
            successToast("Request success !")
            await getList();
        } else {
            errorToast("Request fail !")
        }


    }



}
</script>