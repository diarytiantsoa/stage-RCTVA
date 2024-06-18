const text = "Se connecter !";
const typingText = document.getElementById('text');
var admin = document.getElementById('admin');


let index = 0;

function type() {
  if (index < text.length) {
    typingText.innerHTML += `<span class="typed-letter">${text[index]}</span>`;
    index++;
    setTimeout(type, 70);
  }
}

setTimeout(type, 2500);

