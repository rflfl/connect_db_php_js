const app = document.querySelector('#app');
const xhr = new XMLHttpRequest();

xhr.open('GET', './include/consulta.php', true);
xhr.onload = function () {
    if (xhr.status !== 200) {
        return;
    }

    const dados = JSON.parse(xhr.responseText);
    dados.forEach((element) => {
        item(element);
    });
};
xhr.send();

function item(data) {
    const block = document.createElement('div');
    const title = document.createElement('h2');
    const thumb = document.createElement('img');
    const list = document.createElement('ul');
    const listItem = document.createElement('li');

    thumb.setAttribute('src', data.link_thumb || 'https://via.placeholder.com/320x180?text=Sem+imagem');
    thumb.setAttribute('alt', `Imagem do registro ${data.codigo}`);
    title.textContent = `TIPO: ${data.subtipo}`;
    listItem.textContent = `CÓDIGO: ${data.codigo}`;

    block.appendChild(title);
    list.appendChild(listItem);
    block.appendChild(list);
    block.appendChild(thumb);

    app.appendChild(block);
}
