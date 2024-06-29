document.addEventListener('DOMContentLoaded', function () {
    // استهداف العناصر
    const openMenuButton = document.querySelector('.menu-button');
    const closeMenuButton = document.querySelector('.close-menu');
    const appLeft = document.querySelector('.app-left');
    const editLinks = document.querySelectorAll('.edit-link');
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close');
    const productNameInput = document.getElementById('editProductName');
    const productIngredientsInput = document.getElementById('editIngredients');
    const productInstructionsInput = document.getElementById('editInstructions');
    const productImagePreview = document.getElementById('editImagePreview');
    const editForm = document.getElementById('editForm');

    // إضافة حدث النقر لفتح القائمة
    openMenuButton.addEventListener('click', function () {
        appLeft.classList.add('show');
    });

    // إضافة حدث النقر لإغلاق القائمة
    closeMenuButton.addEventListener('click', function () {
        appLeft.classList.remove('show');
    });

    // إضافة حدث النقر لفتح النافذة المنبثقة للتعديل
    editLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const productData = JSON.parse(link.getAttribute('data-product'));
            productNameInput.value = productData.name;
            productIngredientsInput.value = productData.ingredients;
            productInstructionsInput.value = productData.instructions;
            productImagePreview.src = productData.image;
            modal.style.display = "block";
        });
    });

    // إضافة حدث النقر لإغلاق النافذة المنبثقة
    closeBtn.addEventListener('click', function () {
        closeModal();
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // إضافة حدث إرسال النموذج لحفظ التعديلات
    // editForm.addEventListener('submit', function (event) {
    //     event.preventDefault();
    //     // هنا يمكن إضافة الكود لحفظ التعديلات
    //     alert('تم حفظ التعديلات بنجاح');
    //     closeModal();
    // });

    // تعريف الدالة closeModal
    function closeModal() {
        modal.style.display = "none";
    }
});

// دالة فتح النافذة المنبثقة للتعديل
function openEditModal(token) {
    document.getElementById('editToken').value = token; // تعيين قيمة الـ token في حقل الإدخال المخفي
    document.getElementById('editModal').style.display = 'block'; // عرض النافذة المنبثقة
}
