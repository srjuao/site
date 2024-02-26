document.addEventListener('DOMContentLoaded', function() {
    // Simula o login do usuário
    const user = {
        id: 1,
        name: 'Usuário Teste',
        profilePicture: 'profile.jpg', // Caminho da foto de perfil do usuário
        videos: ['video1.mp4', 'video2.mp4'] // Vídeos postados pelo usuário
    };

    // Carrega o feed de vídeos ao carregar a página
    loadVideos();

    // Exibe o perfil do usuário e seus vídeos ao clicar em "Meu Perfil"
    const perfilLink = document.querySelector('nav ul li:nth-child(2) a');
    perfilLink.addEventListener('click', function(event) {
        event.preventDefault();
        showProfile();
    });

    // Envia um vídeo quando o formulário é submetido
    const uploadForm = document.getElementById('upload-form');
    uploadForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(uploadForm);
        formData.append('userId', user.id); // Adiciona o ID do usuário ao FormData

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Vídeo enviado com sucesso!');
                // Atualiza a lista de vídeos após o envio bem-sucedido
                loadVideos();
            } else {
                alert('Erro ao enviar o vídeo: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao enviar o vídeo:', error);
            alert('Erro ao enviar o vídeo. Verifique o console para mais detalhes.');
        });
    });

    // Função para carregar o feed de vídeos
    function loadVideos() {
        fetch('videos.php')
            .then(response => response.json())
            .then(videos => {
                const videoGrid = document.getElementById('video-grid');
                videoGrid.innerHTML = '';

                videos.forEach(video => {
                    const videoElement = document.createElement('div');
                    videoElement.classList.add('video');
                    videoElement.innerHTML = `
                        <video src="${video.path}" controls></video>
                    `;
                    videoGrid.appendChild(videoElement);
                });
            })
            .catch(error => console.error('Erro ao carregar vídeos:', error));
    }

    // Função para exibir o perfil do usuário
    function showProfile() {
        const profileSection = document.getElementById('perfil');
        profileSection.style.display = 'block';

        const profileInfo = document.getElementById('profile-info');
        profileInfo.innerHTML = `
            <h3>${user.name}</h3>
            <img src="${user.profilePicture}" alt="Foto de Perfil">
        `;

        const profileVideos = document.getElementById('profile-videos');
        profileVideos.innerHTML = '';
        user.videos.forEach(video => {
            const videoElement = document.createElement('div');
            videoElement.classList.add('video');
            videoElement.innerHTML = `
                <video src="${video}" controls></video>
            `;
            profileVideos.appendChild(videoElement);
        });

        // Oculta o feed de vídeos
        const homeSection = document.getElementById('home');
        homeSection.style.display = 'none';
    }
});
