document.addEventListener('livewire:init', function () {
    Livewire.hook('request', ({
        respond,
        fail
    }) => {
        document.getElementById('snipper-loading').style.display = 'block';
        respond(({
            status,
            response
        }) => {
            document.getElementById('snipper-loading').style.display = 'none';
        })

        fail(({
            status,
            preventDefault
        }) => {
            // preventDefault();
            const alertManager = new AlertManager();
            if (status === 403) {
                alertManager.showAlert('ليس لديك الصلاحيات اللازمة لتنفيذ هذا الإجراء.', 'danger');
            } else if (status === 503) {
                alertManager.showAlert('الخادم غير متوفر حاليًا. يرجى المحاولة لاحقًا.', 'danger');
            } else if (status === 500) {
                alertManager.showAlert('خطأ داخلي في الخادم.', 'danger');
            } else if (status === 404) {
                alertManager.showAlert('المورد المطلوب غير موجود.', 'danger');
            } else {
                alertManager.showAlert('حدث خطأ غير متوقع.', 'danger');
            }
        })
    });

    Livewire.on('error', function(event) {
        const alertManager = new AlertManager();
        alertManager.showAlert(event[0],'danger');
    });

});


function hiddenModel(nameMdel, response) {
    const alertManager = new AlertManager();
    const modal = document.getElementById('modal-' + nameMdel);
    const modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
    // resetModal(modal);
    if (response) {
        alertManager.showAlert(response[0].message, response[0].status);
    }
}

// تخصيص نافذة تأكيد مخصصة
function customConfirm(id, name, event) {

    const confirmButton = document.getElementById("modal-accept");
    document.getElementById('modal-description').innerHTML = `
    <p>هل أنت متأكد من رغبتك في حذف القسم (${name}) بشكل نهائي؟</p>
    <p>يرجى ملاحظة أنه لا يمكن تنفيذ هذه العملية إذا كانت هناك بيانات مرتبطة بهذا القسم.</p>
    `;


    // عند النقر على تأكيد
    confirmButton.onclick = () => {
        Livewire.dispatch(event, { 'id': id });
    };
}

function showDetails(id, event) {
    Livewire.dispatch(event, { 'id': id });
}