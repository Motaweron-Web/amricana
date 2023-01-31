
let boxs = document.querySelectorAll('.box');

let items = document.querySelectorAll('.item');
let modalChoose = document.querySelector('.modalChoose');
let btnclose = document.querySelector('.btn-close-choose');
let modalContentChoose = document.querySelector('.modalContentChoose');
let btnColor = document.querySelectorAll('.box-color');



     items.forEach(item=>{
        item.addEventListener('dragstart', function(){
            drag = item;
            item.style.opacity = '0.5';
        });

        item.addEventListener('dragend', function(){

            item.style.opacity = '1';
        });

        boxs.forEach(box=>{
            box.addEventListener('dragover', function(e){
                e.preventDefault();
            });

            box.addEventListener('dragleave', function(){
            });

            box.addEventListener('drop', function(){
                this.append(drag);

                modalChoose.style.display = "block";
                    btnclose.addEventListener('click',function(){
                        modalChoose.style.display = "none";
                    });
                    modalChoose.addEventListener('click',function(){
                        modalChoose.style.display = "none";
                    });
                    modalContentChoose.addEventListener('click',function(e){
                        e.stopPropagation();
                    });


                    btnColor.forEach(color =>{
                        color.addEventListener('click', () => {
                            let dataColor = color.getAttribute('data-color');
                            drag.style.backgroundColor = dataColor;
                        });
                    });

            });
        });
    });

    // waiting room

let boxsWait = document.querySelectorAll('.box-wait');

let itemsWait = document.querySelectorAll('.item-wait');

let modal = document.querySelector('.modal');
let close = document.querySelector('.btn-close');
let modalContent = document.querySelector('.modal-content');
// let btnColor = document.querySelectorAll('.box-color');

itemsWait.forEach(item=>{
        item.addEventListener('dragstart', function(){
            drag = item;
            item.style.opacity = '0.5';
        });

        item.addEventListener('dragend', function(){

            item.style.opacity = '1';
        });

        boxsWait.forEach(box=>{
            box.addEventListener('dragover', function(e){
                e.preventDefault();
            });

            box.addEventListener('dragleave', function(){
            });

            box.addEventListener('drop', function(){
                this.append(drag);

                    modal.style.display = "block";
                    close.addEventListener('click',function(){
                        modal.style.display = "none";
                    });
                    modal.addEventListener('click',function(){
                        modal.style.display = "none";
                    });
                    modalContent.addEventListener('click',function(e){
                        e.stopPropagation();
                    });


                    btnColor.forEach(color =>{
                        color.addEventListener('click', () => {
                            let dataColor = color.getAttribute('data-color');
                            drag.style.backgroundColor = dataColor;
                        });
                    });

            });
        });
    });
