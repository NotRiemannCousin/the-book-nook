const body = document.getElementsByTagName("body")[0];
// const gridExpandBtn = ;
var gridExpand = [];



document.addEventListener("DOMContentLoaded", init, false);
window.addEventListener("resize", reCalcGridExpand, false);



function outerHeight(el) {
    var height = el.offsetHeight;
    var style = getComputedStyle(el);

    height += parseInt(style.marginTop) + parseInt(style.marginBottom);
    return height;
}

function init() {
    reCalcGridExpand();
    startGridExpand();
}


function startGridExpand() {
    let btn = Array.from(document.querySelectorAll('.grid-expand-btn'));


    btn.forEach(el => {
        let closest = el.closest('.grid-expand');
        let previus = el.previousElementSibling;

        if (closest)
            gridExpand.push({ 'expanded': closest, 'button': el });
        else if (previus.classList.contains('grid-expand'))
            gridExpand.push({ 'expanded': previus, 'button': el });
    });


    gridExpand.forEach((el, index) => {
        el['button'].addEventListener('click', () => {
            gridExpandOn(index);
        }
        );
        setTimeout(() => {
            el['expanded'].style.setProperty('transition-duration', '0.5s');
            reCalcGridExpand();
        }, 1);
    }
    );
}


function reCalcGridExpand() {
    gridExpand.forEach(el => {
        el['expanded'].style.setProperty('--height',
            outerHeight(el['expanded'].firstElementChild) + 'px');

        el['expanded'].style.setProperty('--max-height',
            el['expanded'].scrollHeight + 'px');

        // console.log(el['expanded'].style.getPropertyValue("--columns-expand"));
        if (el['expanded'].childElementCount < el['expanded'].style.getPropertyValue("--columns-expand"))
            el['expanded'].setAttribute('data-no-expand');
    });
};

function gridExpandOn(index) {
    gridExpand[index]['expanded'].toggleAttribute('data-grid-expanded');
};
