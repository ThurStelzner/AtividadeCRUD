<?php
// funcoes.php — funções reutilizáveis

/**
 * Retorna o array de contatos.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterContatos(): array {
    return [
        ['nome' => 'Ana Silva',     'email' => 'ana.silva@email.com',     'telefone' => '(11) 91234-5678'],
        ['nome' => 'Bruno Costa',   'email' => 'bruno.costa@email.com',   'telefone' => '(21) 98765-4321'],
        ['nome' => 'Carla Mendes',  'email' => 'carla.mendes@email.com',  'telefone' => '(31) 99876-5432'],
        ['nome' => 'Diego Rocha',   'email' => 'diego.rocha@email.com',   'telefone' => '(41) 97654-3210'],
        ['nome' => 'Elena Ferreira','email' => 'elena.ferreira@email.com','telefone' => '(51) 96543-2109'],
    ];
}

/**
 * Renderiza a tabela HTML com a lista de contatos.
 */
function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<p>Nenhum contato encontrado.</p>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($contatos as $indice => $contato) {
        $num   = $indice + 1;
        $nome  = htmlspecialchars($contato['nome']);
        $email = htmlspecialchars($contato['email']);
        $fone  = htmlspecialchars($contato['telefone']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}
