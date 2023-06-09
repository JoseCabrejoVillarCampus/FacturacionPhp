import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
export class myBody extends HTMLElement {
    constructor() {
        super();
        document.adoptedStyleSheets.push(styles);
    }
    async components() {
        return await (await fetch("view/my-body.html")).text();
    }
    async add(e){
        let $ = e.target;
        this.cantidad = this.querySelector(("#products")).childElementCount;
        if ($.nodeName == "BUTTON" && this.cantidad>1) {
            this.plantilla = this.querySelector("#products").lastElementChild;
            this.plantilla = this.plantilla.cloneNode(true);//duplica e inserta
            document.querySelector("#products").insertAdjacentElement("beforeend", this.plantilla);
        } else{
            document.querySelector("#products").insertAdjacentElement("beforeend", this.plantilla);
        }
    }
    async send(e){
        let input = document.querySelectorAll("input");
        let info = {}, producto = {}, lista = {}, data = {}, count = 0;
        producto.product = [];
        input.forEach((val, id) => {
            if (id <= 7) {
                info[val.name] = val.value;
            } else if (count <= 4) {
                lista[val.name] = val.value;
                count++;
                if (count == 4) {
                producto.product.push(lista);
                lista = {};
                count = 0;
                }
            }
        });
        data.info = info;
        data.producto = producto.product;
        
        let peticion = await fetch("uploads/app.php");
        let res = await peticion.text();
        console.log(res);
    }
    connectedCallback() {
        this.components().then(html => {
            this.innerHTML = html;
            this.add = this.querySelector("#add").addEventListener("click", this.add.bind(this));
            this.send = this.querySelector("#send").addEventListener("click", this.send.bind(this));
        })
    }
}
customElements.define('my-body', myBody);