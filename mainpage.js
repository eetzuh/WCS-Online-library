
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