O **Recognations coins** é um projeto de reconhecimento entre pares desenvolvida para fortalecer a cultura organizacional. O sistema permite que colaboradores enviem moedas de agradecimento, acompanhem estatísticas de engajamento e compartilhem conquistas diretamente com a equip..

---

## 🚀 Funcionalidades

### 📊 Painel de Monitoramento
* **Feed de Doações:** Visualização detalhada de todas as interações com informações completas.
* **Filtros Avançados:** Busca por campo de texto e filtragem por intervalo de datas.
* **KPIs Estratégicos:** Cards com total de doações geral, destaque para o "Maior Doador" e a pessoa com o "Maior Saldo" da rede.

### 💸 Gestão de Reconhecimento
* **Fluxo de Doação:** Tela intuitiva para criar novas doações e enviar moedas.
* **Social Sharing:** Botão para visualizar doação individual e disparar notificação para o **WhatsApp** do grupo de trabalho, com mensagem pré-formatada contendo o motivo, destinatário e valor.

### 👥 Perfil e Estatísticas de Membros
* **Dashboard Individual:** Tela com métricas específicas de cada colaborador.
* **Indicadores:** * Última doação recebida e enviada.
    * Totais acumulados (Enviados vs. Recebidos).
    * Saldo atual e **Média de Moedas** por transação realizada.
* **Extrato de Movimentações:** Tela dedicada com filtros por tipo (Todos, Enviados, Recebidos) e seletor de data.

---

## 🛠️ Stack Técnica e Boas Práticas

Este projeto foi construído utilizando padrões de arquitetura modernos para garantir robustez e manutenibilidade:

* **Framework:** [Laravel](https://laravel.com/) (PHP)
* **Painel Administrativo:** [Filament PHP](https://filamentphp.com/)
* **Banco de Dados:** MySQL
* **Padrões de Projeto (Design Patterns):**
    * **Repository:** Para abstração da camada de dados.
    * **Interfaces:** Garantindo contratos sólidos entre camadas.
    * **Service:** Centralização das regras de negócio e cálculos de saldo.
    * **Observers:** Utilizados para gatilhos de eventos após doações.
<img width="1875" height="925" alt="image" src="https://github.com/user-attachments/assets/e738cc0d-a8be-4cb4-8e37-d55371e6c854" /><br>
<img width="1908" height="878" alt="image" src="https://github.com/user-attachments/assets/f502b778-738c-4fa1-baa4-62ba332fd89e" />


