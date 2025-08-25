document.addEventListener("DOMContentLoaded", function() {
    let addBtn = document.getElementById("add-item-btn");
    let itemsContainer = document.getElementById("items-container");
    let template = document.getElementById("order-item-template");
let items=document.querySelector('.item-num');    
let itemCount = 0;
    addBtn.addEventListener("click", function() {
        itemCount++;
        
        // Clone template
        let newItem = template.cloneNode(true);
        newItem.classList.remove("hidden");
        newItem.id = ""; // remove duplicate id
        newItem.querySelector(".item-number").innerText = itemCount;
       
        // Append to container
        itemsContainer.appendChild(newItem);
       items.innerText="Items : "+ itemCount;

    });

    // Add first item automatically
    addBtn.click();
});