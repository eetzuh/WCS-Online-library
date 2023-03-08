
let tableRows=document.getElementsByTagName('tr');
console.log(tableRows.length)
for(let i=1;i<tableRows.length;i++){
    let row=document.getElementById('availability-'+i)
    if(row.innerHTML=='Dostupno'){
        row.style='color:green'
    }else{
        row.style='color:red'
    }

}