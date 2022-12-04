function restrict(tis) {
    let prev = tis.getAttribute("data-prev");
    prev = (prev !== '') ? prev : '';
    if (Math.round(this.value*100)/100!==tis.value)
        tis.value=prev;
    tis.setAttribute("data-prev",tis.value)
}