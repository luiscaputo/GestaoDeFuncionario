const listdatabase = async () => {
  const res = await axios({
    method: 'get',
    url: 'https://localhost:5001/newdatabase/listdatabase',
  });
 
  var contador=0;
  var table = document.getElementById('tabelamysql');
  table.innerHTML = ' ';

  for (let element of res.data) {
    contador++;
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    row.insertCell(0).innerHTML =contador;
    row.insertCell(1).innerHTML = element['host'];
    row.insertCell(2).innerHTML =element['porta'];
    row.insertCell(3).innerHTML =element['user'];
    row.insertCell(4).innerHTML =element['senha'];
    row.insertCell(5).innerHTML =element['namedatabase'];
    row.insertCell(6).innerHTML='<a href="#" onclick="deleteequipa('+"'"+ element['idusuario']+ "'"+')">Eliminar <i class="mdi mdi-window-close"></i></a> &nbsp;&nbsp;&nbsp; <a href="#">Editar <i class="mdi mdi-database-plus menu-icon"></i></a>'
    
  }
};

listdatabase();

const  createnewbd = async () => {

  const obj = {
    host: valor_da_txt('host'),
    user: valor_da_txt('user'),
    senha: valor_da_txt('senha'),
    namedatabase: valor_da_txt('namedatabase'),
    Porta: valor_da_txt('porta'),
  };
  //https://localhost:5001/newdatabase/creatnewbd
  await methodPost(obj,'https://localhost:5001/newdatabaseController/addnewbd');

  await listdatabase();
};

