const pluss = document.getElementById("addmultipleplus");
const table = document.getElementById("table");
const html = `
    <tr>
        <td><input type="text" class="form-control" name="name[]" id="name" required></td>
            <td><input type="number" name="price[]" class="form-control" id="price" required>
            </td>
            <td><input class="form-control form-control-sm" name="image[]" style="width:200px;" id="image"
                    type="file"></td>
            <td><select class="form-select" id="category" name="category[]" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="mobile">Mobile</option>
                    <option value="camera">Camera</option>
                    <option value="laptop">Laptop</option>
                </select></td>
            <td><input type="text" class="form-control" name="description[]" id="description" required>
            </td>
            <td><button id="addmultipleminus" class="addmultipleminus" type="button"><i class="fa-solid fa-minus" style="color: #74C0FC;"></i></button>
            </td>
    </tr>
    `;
let num = 0;

function plusFunction() {
    let newRow = table.insertRow(table.rows.length);
    newRow.innerHTML = html;
    //    alert(num);
    let elements = document.getElementById("addmultipleminus");
    let name = document.getElementById("name");
    let price = document.getElementById("price");
    let image = document.getElementById("image");
    let description = document.getElementById("description");
    let category = document.getElementById("category");
          elements.id += "_" +num;
          name.id += "_" +num;
          price.id += "_" +num;
          image.id += "_" +num;
          description.id += "_" +num;
          category.id += "_" +num;

    let buttons=document.getElementsByClassName("addmultipleminus");
    // console.log(buttons);
     for(let i=0;i<buttons.length;i++){
        buttons[i].addEventListener('click',function(){
            this.parentNode.parentNode.remove();
        })
    }
 }
pluss.addEventListener("click", function(){
    plusFunction(num++);
});

