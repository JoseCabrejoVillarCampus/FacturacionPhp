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
        /**
         * todo: Miguel del futuro arregle esto ▼ 
         * ? Arreglar esto se duplica :(
         * 
         */
        let $ = e.target;
        if ($.nodeName == "BUTTON") {
            let plantilla = this.querySelector("#products").children;
            plantilla = plantilla[plantilla.length-1];
            plantilla = plantilla.cloneNode(true);//duplica e inserta
            document.querySelector("#products").insertAdjacentElement("beforeend", plantilla);
        
        }
    }
    connectedCallback() {
        this.components().then(html => {
            this.innerHTML = html;
            this.add = this.querySelector("#add").addEventListener("click", this.add.bind(this));
        
        })
    }
}
customElements.define('my-body', myBody);