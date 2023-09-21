let searchButton=document.getElementById('searchBtn')
searchButton.addEventListener('input',getProduct)
let searchResults=document.getElementById('searchOutput')

function getProduct(){
    console.log(searchButton.value)
    const xhr =new XMLHttpRequest()

    xhr.onload=function(){
        let data=JSON.parse(this.responseText)
        let temp='<div class="list-group">'
        for (row of data['message']){
            temp+=`<a href="#${row['id']}" class="list-group-item list-group-item-action">${row['Name']}</a>`
            console.log(row)
        }
        temp+='</div>'
        searchResults.innerHTML=temp
    }

    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/searchProduct.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "Name":"${searchButton.value}"
    }`)
}