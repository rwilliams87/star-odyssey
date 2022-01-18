function hamburgerMenu() {
    let x = document.getElementById('hamburgermenu');
    let y = document.getElementById('main');

    if (x.style.display === 'grid') {
        x.style.animationName = 'slideout';
        setTimeout(() => y.style.display = 'flex', 200);
        setTimeout(() => x.style.display = 'none', 200);
    } else {
        x.style.animationName = 'slidein';
        y.style.display = 'none';
        x.style.display = 'grid';
    }

}

function graphMainPopulation() {

}