function Cidade() {
    this.id;
    this.nome;
    this.uf;

    this.getCidadeForm = function() {
        this.nome = document.getElementById('nomeInput').value;
        this.uf = document.getElementById('ufInput').value;
    }
}

function Bairro() {
    this.id;
    this.nome;
    this.cidade;

    this.getBairroForm = function() {
        this.nome = document.getElementById('nomeInput').value;
        this.cidade = new Cidade();
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

    this.getEnderecoForm = function() {
        this.cep = document.getElementById('cepInput').value;
        this.logadouro = document.getElementById('logadouroInput').value;
        this.numero = document.getElementById('numeroInput').value;
        this.complemento = document.getElementById('complementoInput').value;

        this.bairro = new Bairro();
        this.bairro.getBairroForm();
    }
}

function Contato() {
    this.id;
    this.ddd;
    this.telefone;

    this.getContatoForm = function(index) {
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

    this.getClienteForm = function() {
        this.nome = document.getElementById('nomeInput').value;
        this.email = document.getElementById('emailInput').value;
        this.tipoPessoa = document.querySelector('input[name="tipoPessoaRadio"]:checked').value;
        this.cpfCnpj = document.getElementById('cpfCnpjInput').value;

        this.endereco = new Endereco();
        this.endereco.getEnderecoForm();

        this.contatos = [];

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
