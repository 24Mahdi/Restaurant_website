
document.addEventListener('DOMContentLoaded', function () {
    // استهداف العناصر
    const openMenuButton = document.querySelector('.menu-button');
    const closeMenuButton = document.querySelector('.close-menu');
    const appLeft = document.querySelector('.app-left');

    // إضافة حدث النقر لفتح القائمة
    openMenuButton.addEventListener('click', function () {
        appLeft.classList.add('show');

    });

    // إضافة حدث النقر لإغلاق القائمة
    closeMenuButton.addEventListener('click', function () {
        appLeft.classList.remove('show');
    });
});

document.getElementById('delete-rules-btn').addEventListener('click', function () {
    var sheets = document.styleSheets;
    for (var i = 0; i < sheets.length; i++) {
        var sheet = sheets[i];
        try {
            var rules = sheet.cssRules;
            for (var j = rules.length - 1; j >= 0; j--) {
                var rule = rules[j];
                if (rule.selectorText === '.app-main') {
                    sheet.deleteRule(j);
                    // حذف قاعدتين، لذا نكرر العملية مرة أخرى
                    if (sheet.cssRules[j - 1] && sheet.cssRules[j - 1].selectorText === '.app-main') {
                        sheet.deleteRule(j - 1);
                    }
                    break; // نخرج من الحلقة لأننا وجدنا وحذفنا القاعدة
                }
            }
        } catch (e) {
            console.warn("Cannot modify stylesheet: ", sheet.href, e);
        }
    }
});

