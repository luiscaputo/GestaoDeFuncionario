const listuser = async () => {
  const res = await axios({
    method: 'get',
    url: 'https://localhost:5001/CreatNewuser/listuser',
  });
 
  var contador=0;
  var table = document.getElementById('listuser');
  table.innerHTML = ' ';

  
  
  for (let element of res.data) {
    contador++;
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    row.insertCell(0).innerHTML =contador;
    row.insertCell(1).innerHTML = '<img src="../../assets/images/faces/'+element['imagem']+'" class="mr-2" alt="image"> '+element['nome']+'';
    row.insertCell(2).innerHTML =element['email'];
    row.insertCell(3).innerHTML =element['github'];
    row.insertCell(4).innerHTML =element['cargo'];
    row.insertCell(5).innerHTML =element['programador'];
    row.insertCell(6).innerHTML ='<label class="badge badge-gradient-success">'+element['estato']+'</label>';
    row.insertCell(7).innerHTML='<a href="#" onclick="deleteequipa('+"'"+ element['idusuario']+ "'"+')">Eliminar <i class="mdi mdi-window-close"></i></a> &nbsp;&nbsp;&nbsp; <a href="#">Editar <i class="mdi mdi-database-plus menu-icon"></i></a>'
    
  }
};

listuser();

const  addequipa = async () => {

  const objequipa = {
    Nome: valor_da_txt('nomeuser'),
    Email: valor_da_txt('emailuser'),
    Github: valor_da_txt('githubuser'),
    Cargo: valor_da_txt('cargouser'),
    Programador: valor_da_txt('Programadoruser'),
    senha: valor_da_txt('senhauser'),
    imagem: valor_da_txt('fotouser'),
  };
  
  methodPost(objequipa,'https://localhost:5001/CreatNewuser/CreatNewuser');

  await listuser();
};


function deleteequipa (valor){
  
  const objequipa = {
    Idusuario: ''+valor+'',
  };
  methodPost(objequipa,'https://localhost:5001/CreatNewuser/delete');
   listuser();
}