<?php

// conexão com o banco
include('db.php');

// rotas dos endpoints a serem usados no backend
switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id !== null) {
            // GET por ID
            $stmt = $pdo->prepare("SELECT * FROM garantia_motivo WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                echo json_encode($data);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "ID nao encontrado"]);
            }
        } else {
            // GET completo
            $stmt = $pdo->query("SELECT * FROM garantia_motivo");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        }
        break;

    case 'POST':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do POST
            $data = json_decode(file_get_contents("php://input"), true);
        
            // Verifica se o campo 'descricao' está presente nos dados
            if (isset($data['descricao'])) {
                $descricao = $data['descricao'];
        
                // Verifica se a descrição não está vazia
                if (empty($descricao)) {
                    http_response_code(400);
                    echo json_encode(["error" => "Campo 'descricao' e obrigatorio"]);
                    exit;
                }
        
                try {
                    // Conexão com o banco de dados usando PDO
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                    // Prepara a consulta SQL
                    $stmt = $pdo->prepare("INSERT INTO garantia_motivo (descricao) VALUES (:descricao)");
                    $stmt->bindParam(':descricao', $descricao);
        
                    // Executa a consulta
                    $stmt->execute();
        
                    http_response_code(201);
                    echo json_encode(["message" => "Descricao inserida com sucesso"]);
                } catch (PDOException $e) {
                    http_response_code(500);
                    echo json_encode(["error" => "Erro ao inserir descricao: " . $e->getMessage()]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Campo 'descricao' e obrigatorio"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Requisicao invalida"]);
        }
        break;

    case 'PUT':        
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id']) && isset($data['descricao'])) {
            $id = $data['id'];
            $descricao = $data['descricao'];

            try {
                $stmt = $pdo->prepare("UPDATE garantia_motivo SET descricao = :descricao WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->execute();

                http_response_code(200);
                echo json_encode(["message" => "Descricao atualizada com sucesso"]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["error" => "Erro ao atualizar descricao: " . $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Requisicao invalida"]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'])) {
            $id = $data['id'];

            try {
                // Deleta o registro pelo ID
                $stmt = $pdo->prepare("DELETE FROM garantia_motivo WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                http_response_code(200);
                echo json_encode(["message" => "Registro deletado com sucesso"]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["error" => "Erro ao deletar registro: " . $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "ID inválido"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Metodo nao permitido"]);
}
?>
