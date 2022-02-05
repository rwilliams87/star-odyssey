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

function messagesBoxCount(count, display) {
    let chars = document.getElementById(count).value.length;
    let trueLength = 255 - chars;
    document.getElementById(display).innerHTML = `${trueLength} characters remaining.`;
}

function messagesCheckAll(source) {
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source) checkboxes.checked = source.checked;
    }
}

function messagesConfirmDelete() {
    document.getElementById('confirm').style.display = 'block';
    document.getElementById('delete').style.display = 'none';
}

function researchConfirmUnlock(a, b) {
    document.getElementById(a).style.display = 'none';
    document.getElementById(b).style.display = 'block';
}

function change(selection) {
    document.getElementById('attackCarrier').style.display = 'none';
    document.getElementById('defenseCarrier').style.display = 'none';
    document.getElementById('heavyCarrier').style.display = 'none';
    document.getElementById('specialCarrier').style.display = 'none';
    document.getElementById(selection).style.display = 'block';
  }