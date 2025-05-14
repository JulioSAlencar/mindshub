import "./bootstrap";
import "./sidebar";
import "./toggle";
import iniciarTemporizadorInatividade from './inatividade.js';

// 10 minutos e redireciona para "/sair"
// iniciarTemporizadorInatividade(10 * 60 * 1000, "/logout");

// Coloquei inicialmente 30seg para testar, porém se conseguir rodar tu vai e aplica o de 10 minutos ai de cima ^
iniciarTemporizadorInatividade(30000); 


import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
