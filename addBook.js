let toggleAuthorInput='not selected';
let toggleCategoryInput='not selected';



function toggleAddItem(item){
    if(item=='author'){
        selected=toggleAuthorInput;
    }else{
        selected=toggleCategoryInput;
    }
    let addItemButton=document.querySelector('#'+item+'-input-button')
    let addItemButtonPATH=document.querySelector('.' +item+'-button-path')
    if(selected=="not selected"){
        document.querySelector('#'+item+'-btn').style='display:flex'
        document.querySelector('.new-'+item).style='display:flex'
        addItemButton.classList.replace('bi.bi-plus-square-dotted','bi.bi-dash-square-dotted')
        addItemButtonPATH.setAttribute('d', 'M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834 0h.916v-1h-.916v1zm1.833 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z')
        selected='selected'
    }else{
        document.querySelector('#'+item+'-btn').style='display:none'
        document.querySelector('.new-'+item).style='display:none'
        document.querySelector('.new-'+item).value='';
        addItemButton.classList.replace('bi.bi-dash-square-dotted','bi.bi-plus-square-dotted')
        addItemButtonPATH.setAttribute('d', 'M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z')
        selected='not selected'
    }
    if(item=='author'){
        toggleAuthorInput=selected;
    }else{
       toggleCategoryInput=selected;
    }
}

function checkFields(form){
    let authorsInput=document.getElementsByClassName('added_author')
    let categoriesInput=document.getElementsByClassName('added_category')
    function stopSubmit(e){
        e.preventDefault()
    }
    if(!(authorsInput.length!=0 && categoriesInput.length!=0)){
        document.getElementById(form).addEventListener('submit', stopSubmit)
        document.getElementById('inputWarning').innerHTML='Sva polja moraju biti popunjena'
        setTimeout(function(){
            document.getElementById(form).removeEventListener('submit', stopSubmit)
        }, 2000)
 }
}

function appendInput(text, div, item, type, form ){
    let container= document.createElement('div');
    let addInput=document.createElement('input')
    if(form=="edit"){
        addInput.setAttribute('form', 'editForm')
    }
    addInput.setAttribute('name', type+'_'+item+'[]')
    addInput.setAttribute('type', 'text')
    addInput.setAttribute('style', 'display:none')
    addInput.setAttribute('value', text.value)
    container.appendChild(addInput);
    let addLabel=document.createElement('label')
    addLabel.innerText=text.value
    addLabel.setAttribute('for', type+'_'+item)
    addLabel.setAttribute('class','added_'+item)
    container.appendChild(addLabel)
    container.setAttribute('onclick', 'this.remove()')
    div.appendChild(container)
}

function addItem(newElem, form){
    
    let selectedDiv=document.querySelector('#selected-'+newElem)
    let inputValue=document.querySelector('.new-'+newElem)
    if(inputValue.value!==""){
        appendInput(inputValue, selectedDiv, newElem, 'new', form)
    }
    inputValue.value=""
}

function chosenItem(selectedElem, form){
    item=''
    if(selectedElem.id=="selectCategory"){
        item='category'
    }else{
        item='author'
    }
    let optionsList=document.getElementById('select-'+item).options;
    let optionsListArray=[]
    Array.from(optionsList).forEach(element=> optionsListArray.push(element.value))
    let selectedDiv=document.getElementById('selected-'+item)
    if(optionsListArray.includes(selectedElem.value)){
        appendInput(selectedElem,selectedDiv, item, 'selected', form);
    }
}

