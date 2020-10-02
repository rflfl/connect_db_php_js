 const app = document.querySelector('#app');
        var xhr = new XMLHttpRequest();
        xhr.open("GET", './include/consulta.php', true);

        xhr.onload = function() {
            var data = xhr.responseText;
            if(xhr.status === 200){
               var dados = JSON.parse(data);
                console.log(typeof(dados));
                dados.forEach(element => {
                   item(element)
                });
            }
        };
        xhr.send('string');



        function item(data){
            var block = document.createElement('div');

            var H2 = document.createElement('h2');
            var thumb = document.createElement('img');
            var list = document.createElement('ul');
            var listItem = document.createElement('li');
            console.log(data);
            thumb.setAttribute('src', data[0].link_thumb);
            H2.textContent = "TIPO: " + data.subtipo;
            listItem.textContent = "CÓDIGO: " + data.codigo;
            
            block.appendChild(H2);
            list.appendChild(listItem);
            block.appendChild(list);
            block.appendChild(thumb);

            app.appendChild(block);
        }
