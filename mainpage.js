
let tableRows=document.getElementsByTagName('tr');

console.log(tableRows.length)
for(let i=1;i<tableRows.length;i++){
    let row=document.getElementById('availability-'+i)
    if(row.innerHTML=='Posuđeno'){
        row.style='color:red'
    }else{
        row.style='color:green'
    }

}

function edit(id){
    document.getElementById('editBook'+id).submit()
}

function useBook(type, id){
    document.getElementById(type+'-'+id).setAttribute('value', id)
    document.getElementById(type+'-form-'+id).submit();
    document.getElementById(type+'-'+id).removeAttribute('value', id)
}

function disableButtons(){
    let notAvailableBooks=document.getElementsByClassName('not-available')
    for(let i=0;i<notAvailableBooks.length;i++){
        notAvailableBooks[i].setAttribute('disabled', true)
    }
    let notBorrowedBooks=document.getElementsByClassName('not-borrowed');
    for(let i=0;i<notBorrowedBooks.length;i++){
        notBorrowedBooks[i].setAttribute('disabled', true)
    }
   
}

disableButtons()