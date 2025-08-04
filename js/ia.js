function formatMarkdown(text) {
            // Substitui **texto** por <strong>texto</strong>
            text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            // Substitui _texto_ por <em>texto</em>
            text = text.replace(/_(.*?)_/g, '<em>$1</em>');
            // Substitui \n por <br>
            text = text.replace(/\n/g, '<br>');
            return text;
        }

        async function handleSearch(event) {
            event.preventDefault();
            const query = document.getElementById('query').value.trim();
            if (!query) return;

            const webhook = 'https://n8n-n8n.bqznqa.easypanel.host/webhook/55468fea-aa14-4b74-8e47-8fcccb9cffc1';
            const chatContainer = document.getElementById('chatContainer');
            const searchContainer = document.getElementById('searchContainer');

            // Adiciona a mensagem do usuário com avatar no topo
            const userMessage = document.createElement('div');
            userMessage.className = 'message';
            userMessage.innerHTML = `<div class="avatar user-avatar"><i class="fa-solid fa-user"></i></div><div class="user-message">${query}</div>`;
            chatContainer.prepend(userMessage);

            // Adiciona a animação de "pensando" com avatar no topo
            const thinkingMessage = document.createElement('div');
            thinkingMessage.className = 'message';
            thinkingMessage.innerHTML = `<div class="avatar bot-avatar"><i class="fa-solid fa-robot"></i></div><div class="bot-message"><div class="thinking"><div class="thinking-dot"></div><div class="thinking-dot"></div><div class="thinking-dot"></div></div></div>`;
            chatContainer.prepend(thinkingMessage);

            // Rolagem para o topo (primeira mensagem)
            chatContainer.scrollTop = 0;

            try {
                const response = await fetch(`${webhook}?query=${encodeURIComponent(query)}`, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' }
                });

                const status = response.status;
                const rawResponse = await response.text();
                let data = rawResponse ? JSON.parse(rawResponse) : {};

                // Remove a animação de "pensando" e adiciona a resposta no topo
                chatContainer.removeChild(thinkingMessage);
                let result = '';
                if (typeof data === 'object' && data.output) {
                    result = formatMarkdown(data.output);
                } else if (Array.isArray(data) && data.length > 0 && data[0].output) {
                    result = formatMarkdown(data[0].output);
                } else {
                    result = 'Não consegui processar sua solicitação.';
                }
                const botMessage = document.createElement('div');
                botMessage.className = 'message';
                botMessage.innerHTML = `<div class="avatar bot-avatar"><i class="fa-solid fa-robot"></i></div><div class="bot-message">${result}</div>`;
                chatContainer.prepend(botMessage);

                // Rolagem para o topo (primeira mensagem)
                chatContainer.scrollTop = 0;
            } catch (error) {
                chatContainer.removeChild(thinkingMessage);
                const botMessage = document.createElement('div');
                botMessage.className = 'message';
                botMessage.innerHTML = `<div class="avatar bot-avatar"><i class="fa-solid fa-robot"></i></div><div class="bot-message">Erro ao conectar ao servidor.</div>`;
                chatContainer.prepend(botMessage);
                chatContainer.scrollTop = 0;
            }

            // Limpa o campo de entrada
            document.getElementById('query').value = '';
            searchContainer.classList.add('scrolled');
        }