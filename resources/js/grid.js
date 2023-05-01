const body = document.getElementsByTagName("body")[0];
const gridExpand = document.getElementsByClassName('grid-expand');

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
    let btn = document.querySelectorAll('.grid-expand+.grid-expand-btn');

    for (let i = 0; i < gridExpand.length; i++) {
        btn[i].addEventListener('click', () => {
            gridExpandOn(gridExpand[i], btn[i]);
        }
        );
        setTimeout(() => {
            gridExpand[i].style.setProperty('transition-duration', '0.5s');
            // btn[i].style.setProperty('transition-duration', '0.5s');
            reCalcGridExpand();
        }, 1);
    }
}


function reCalcGridExpand() {
    for (let i = 0; i < gridExpand.length; i++) {
        let el = gridExpand[i];

        el.style.setProperty('--height',
            outerHeight(el.firstElementChild) + 'px');
        el.style.setProperty('--max-height',
            el.scrollHeight + 'px');
// console.log(el.style.getPropertyValue("--columns-expand"));
        if (el.childElementCount < el.style.getPropertyValue("--columns-expand"))
            el.setAttribute('data-no-expand');
    }
};

function gridExpandOn(element, btn) {
    element.toggleAttribute('data-grid-expanded');
};
