let getSearchBar = document.getElementById('searchBar');
let getTableBody = document.querySelector('tbody');
let getSelectCompagnie = document.querySelector('#searchByCompagnie');
let registerSearchedCompagnie = '';
let registerSearchLetters = '';

getSearchBar.addEventListener('keyup', function(e){
    searchLine(e.target.value);
});
getSelectCompagnie.addEventListener('change', searchCompagnie);

function searchLine(value){
    registerSearchLetters = value;
    fetch('index.php?search=' + registerSearchLetters + '&compagnie=' + registerSearchedCompagnie)
    .then(response => {return response.json();})
    .then(data => {
        let tableContent = '';
        data.forEach(line => {
            tableContent += '<tr><td>' + line['ligne_name'] + '</td><td>' + line['terminus_a'] + '</td><td>' + line['terminus_b'] + '</td><td>' + line['comp_name'] + '<td><a href="edit.php?id=' +  line['id']  +'">Edit</a><a href="delete.php?id=' +  line['id']  +'">Delete</a></tr>'
        });
        getTableBody.innerHTML = tableContent;
    }).catch(error => console.log("Erreur :" + error.message));
}

function searchCompagnie(event){
    registerSearchedCompagnie = event.target.value;
    fetch('index.php?isCompagnieValid=' + registerSearchedCompagnie)
    .then(response => {return response.text()})
    .then(data =>{
            searchLine(registerSearchLetters);
    }).catch(error => console.log("Erreur :" + error.message));
    ;
}