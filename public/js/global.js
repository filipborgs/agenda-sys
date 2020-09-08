function Cidade() {
    this.id;
    this.nome;
    this.uf;

    this.getCidadeForm = function (json) {
        this.nome = document.getElementById('cidadeInput').value;
        this.uf = document.getElementById('ufInput').value;
        if (json != null) {
            this.id = json.id;
        }
    }
}

function Bairro() {
    this.id;
    this.nome;
    this.cidade;

    this.getBairroForm = function (json) {
        this.nome = document.getElementById('bairroInput').value;
        if (json != null) {
            this.id = json.id;
            this.cidade = new Cidade(json.cidade);
        } else {
            this.cidade = new Cidade(null);
        }
        this.cidade.getCidadeForm();
    }
}

function Endereco() {
    this.id;
    this.cep;
    this.logadouro;
    this.numero;
    this.complemento;
    this.bairro;

    this.getEnderecoForm = function (json) {
        this.cep = document.getElementById('cepInput').value;
        this.logadouro = document.getElementById('logadouroInput').value;
        this.numero = document.getElementById('numeroInput').value;
        this.complemento = document.getElementById('complementoInput').value;

        this.bairro = new Bairro();
        if (json != null) {
            this.id = json.id;
            this.bairro.getBairroForm(json.bairro);
        } else {
            this.bairro.getBairroForm(null);
        }

    }
}

function Contato() {
    this.id;
    this.ddd;
    this.telefone;

    this.getContatoForm = function (index) {
        this.ddd = document.getElementById('ddd-' + index).value;
        this.telefone = document.getElementById('telefone-' + index).value;
    }
}

function Cliente() {
    this.id;
    this.nome;
    this.email;
    this.tipoPessoa;
    this.cpfCnpj;
    this.endereco;
    this.contatos;

    this.getClienteForm = function (edicao) {
        this.nome = document.getElementById('nomeInput').value;
        this.email = document.getElementById('emailInput').value;
        this.tipoPessoa = document.querySelector('input[name="tipoPessoaRadio"]:checked').value;
        this.cpfCnpj = document.getElementById('cpfCnpjInput').value;

        let json = JSON.parse(window.sessionStorage.getItem('registroJson'));

        this.endereco = new Endereco();

        this.contatos = [];

        if (edicao != null) {
            this.endereco.getEnderecoForm(json.endereco);
            this.id = json.id;
            for (const cont of json.contatos) {
                let contato = new Contato();
                contato.getContatoForm(cont.id);
                this.contatos.push(contato);
            }
        } else {
            this.endereco.getEnderecoForm(null);

            let contador = window.sessionStorage.getItem('contadorTel');
            if (contador === null) {
                let contato = new Contato();
                contato.getContatoForm(1);
                this.contatos.push(contato);
            } else {
                for (let index = 1; index <= contador; index++) {
                    let contato = new Contato();
                    contato.getContatoForm(index);
                    this.contatos.push(contato);
                }
            }
        }

    }
}

function abrirEdicaoRegistro() {
    let tab = document.getElementById("edicaoTab");
    if (tab.style.display === "none") {
        tab.style.display = "block";
        document.getElementById("btnEditarTab").click();
    } else {
        tab.style.display = "none";
        document.getElementById("infoCliente").click();
    }
}

function addRowTelefone() {

    let contador = window.sessionStorage.getItem('contadorTel');
    if (contador === null) {
        contador = 2;
    } else {
        contador = parseInt(contador);
        contador++;
    }

    let row = getRowTelefone(contador);

    document.getElementById('divTelefone').appendChild(row);
    window.sessionStorage.setItem('contadorTel', contador);
}

function getRowTelefone(contador, ddd, telefone) {

    let row = document.createElement('div');
    row.className = "row";

    let divDDD = document.createElement('div');
    divDDD.className = "col-3";

    let inputDDD = document.createElement('input');
    inputDDD.type = "number";
    inputDDD.id = "ddd-" + contador;
    inputDDD.className = "form-control";
    inputDDD.placeholder = "DDD";
    if (ddd != null) {
        inputDDD.value = ddd;
    }
    divDDD.appendChild(inputDDD);

    let divTel = document.createElement('div');
    divTel.className = "col-9";

    let inputTel = document.createElement('input');
    inputTel.type = "number";
    inputTel.value = telefone;
    if (telefone != null) {
        inputTel.value = telefone;
    }
    inputTel.id = "telefone-" + contador;
    inputTel.className = "form-control";
    inputTel.placeholder = "Número";
    divTel.appendChild(inputTel);

    row.appendChild(divDDD);
    row.appendChild(divTel);

    // document.getElementById('divTelefone').appendChild(row);
    // window.sessionStorage.setItem('contadorTel', contador);
    return row;
}
