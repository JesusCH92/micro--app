export function disabled({ element }) {
    element.setAttribute('disabled', 'disabled');
}

export function activated({ element }) {
    element.removeAttribute('disabled');
}