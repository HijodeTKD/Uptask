!function(){let e=[],t=[];!async function(){try{const t="https://pure-wildwood-67751.herokuapp.com/api/tareas?url="+o();console.log(t);const a=await fetch(t),r=await a.json();e=r.tareas,n()}catch(e){console.log(e)}}();function a(a){const o=a.target.value;t=""!==o?e.filter(e=>e.estado===o):[],n()}function o(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).url}function n(){!function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),function(){const t=e.filter(e=>"0"===e.estado),a=document.querySelector("#pendientes"),o=document.querySelector("#pendientes-label");0===t.length?(a.disabled=!0,o.classList.add("hidden")):(a.disabled=!1,o.classList.remove("hidden"))}(),function(){const t=e.filter(e=>"1"===e.estado),a=document.querySelector("#completadas"),o=document.querySelector("#completadas-label");0===t.length?(a.disabled=!0,o.classList.add("hidden")):(a.disabled=!1,o.classList.remove("hidden"))}();const a=t.length?t:e;if(0===a.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const c={0:"Pendiente",1:"Completa"};a.forEach(t=>{const a=document.createElement("LI");a.dataset.tareaId=t.id,a.classList.add("tarea");const d=document.createElement("P");d.textContent=t.nombre,d.onclick=function(){r(!0,{...t})};const i=document.createElement("DIV");i.classList.add("opciones");const l=document.createElement("BUTTON");l.classList.add("estado-tarea"),l.classList.add(""+c[t.estado].toLowerCase()),l.textContent=c[t.estado],l.dataset.estadoTarea=t.estado,l.onclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,s(e)}({...t})};const u=document.createElement("BUTTON");u.classList.add("eliminar-tarea"),u.dataset.idTarea=t.id,u.textContent="Eliminar",u.onclick=function(){!function(t){Swal.fire({title:"¿Eliminar tarea?",text:"¡No podrás revertir los cambios!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Si, eliminar",cancelButtonText:"Cancelar"}).then(a=>{a.isConfirmed&&async function(t){const{estado:a,id:r,nombre:c}=t,s=new FormData;s.append("id",r),s.append("nombre",c),s.append("estado",a),s.append("proyectoid",o());try{const a="https://pure-wildwood-67751.herokuapp.com/api/tarea/eliminar",o=await fetch(a,{method:"POST",body:s}),r=await o.json();r.resultado&&(Swal.fire("¡Eliminada!",r.mensaje,"success"),e=e.filter(e=>e.id!==t.id),n()),console.log(r)}catch(e){}}(t)})}({...t})},i.appendChild(l),i.appendChild(u),a.appendChild(d),a.appendChild(i);document.querySelector("#listado-tareas").appendChild(a)})}document.querySelectorAll('#filtros .filtros-inputs .campo input[type="radio"').forEach(e=>{e.addEventListener("input",a)});function r(t=!1,a={}){console.log(a);const r=document.createElement("DIV");r.classList.add("modal"),r.innerHTML=`\n            <form class="formulario nueva-tarea">\n\n                <legend>${t?"Editar tarea":"Añade una nueva tarea"}</legend>\n\n                <div class="alertas"></div>\n\n                <div class="campo">\n                    <label>Tarea</label>\n                    <input class="tarea" type="text" name="tarea" placeholder="${a.nombre?"Edita la tarea":"Añadir tarea al proyecto actual"}" id="tarea" value="${a.nombre?a.nombre:""}" />\n                </div>\n\n                <div class="opciones">\n                    <input type="submit" class="submit-nueva-tarea" value="${a.nombre?"Actualizar tarea":"Crear tarea"}"/>\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n\n            </form>\n        `,setTimeout(()=>{formulario=document.querySelector(".formulario"),formulario.classList.add("animar")},0),r.addEventListener("click",(function(d){if(d.preventDefault(),d.target.classList.contains("cerrar-modal")&&(formulario=document.querySelector(".formulario"),formulario.classList.add("cerrar"),setTimeout(()=>{r.remove()},500)),d.target.classList.contains("submit-nueva-tarea")){const r=document.querySelector("#tarea").value.trim();if(!r)return void c("error","El nombre de la tarea es obligatorio",document.querySelector(".formulario .alertas"));t?(a.nombre=r,s(a)):async function(t){const a=new FormData;a.append("nombre",t),a.append("proyectoid",o());try{const o="https://pure-wildwood-67751.herokuapp.com/api/tarea",r=await fetch(o,{method:"POST",body:a}),s=await r.json();if(c(s.tipo,s.mensaje,document.querySelector(".formulario .alertas")),s.tipo="exito"){document.querySelector(".tarea").value="";const a={id:String(s.id),nombre:t,estado:"0",proyectoid:s.proyectoid};e=[...e,a],console.log(e),n()}console.log(r)}catch(e){console.log(e)}}(r)}})),document.querySelector(".dashboard").appendChild(r)}function c(e,t,a){const o=document.querySelector(".alerta-contenedor");o&&o.remove();const n=document.createElement("DIV");n.classList.add("alerta-contenedor");const r=document.createElement("DIV");r.classList.add("alerta",e),n.appendChild(r),r.textContent=t,a.appendChild(n)}async function s(t){const{estado:a,id:r,nombre:c}=t,s=new FormData;s.append("id",r),s.append("nombre",c),s.append("estado",a),s.append("proyectoid",o());try{const t="https://pure-wildwood-67751.herokuapp.com/api/tarea/actualizar",o=await fetch(t,{method:"POST",body:s}),d=await o.json();if("exito"===d.respuesta.tipo){Swal.fire(d.respuesta.mensaje,d.respuesta.mensaje,"success");const t=document.querySelector(".modal");t&&t.remove(),e=e.map(e=>(e.id===r&&(e.estado=a,e.nombre=c),e)),n()}}catch(e){console.log(e)}}document.querySelector("#agregar-tarea").addEventListener("click",(function(){r()}))}();