function searchFunction() {
    var input, filter, wrapper, items, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    wrapper = document.getElementsByClassName('flex-container')[0];
    items = wrapper.getElementsByClassName('wrapper');

    for (i = 0; i < items.length; i++) {
        var details = items[i].getElementsByClassName('details')[0];
        txtValue = details.textContent || details.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}

// ربط الدالة مع حدث input لحقل البحث
document.getElementById('searchInput').addEventListener('input', searchFunction);
