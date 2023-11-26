const styles: string[]=['styles/bataty.css','styles/fryteczki.css','styles/baklazan.css'];
const element = document.getElementById('links') as HTMLDivElement;
const styleId= document.getElementById('pageStyle')as HTMLLinkElement;

function  initFunction(){
    for(let i=0;i<styles.length;i++){
        const new_link= document.createElement("a");
        new_link.textContent=`>style ${i+1}<`;
        new_link.href=styles[i];
        new_link.addEventListener("click",(event)=>{
            event.preventDefault();
           styleId.setAttribute("href",new_link.href);
           // console.log("Style: ",new_link.href);
        });
        element.appendChild(new_link);
        element.appendChild(document.createElement("br"));
    }
}
initFunction();