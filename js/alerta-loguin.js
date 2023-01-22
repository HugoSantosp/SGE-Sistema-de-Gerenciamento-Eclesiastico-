
/* Função para O Alerta de Loguin qaunto ao erro dos Dados */

function alertaLoguin(msg){
    let timerInterval
Swal.fire({
  position: 'top-end',
  icon: 'error',
  title:  ''+ msg + '',
  timer: 1000,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* referência para a tela principal do loguin  */
  if (result.dismiss === Swal.DismissReason.timer) {
    window.location = "index.php"
  }
})
}


/* Função para O Alerta de Loguin quando os dados estão corretos PARTA O PAINEL */

function LoguinSucess(msg){
    let timerInterval
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: '<small><small>'+ msg + '</small></small>',
      timer: 1500,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* referência para o painel adminitrativo  */
      if (result.dismiss === Swal.DismissReason.timer) {
        window.location = "painel-adm"
        }
    })
  }     


  function LoguinSucessPastor(msg){
    let timerInterval
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: '<small><small>'+ msg + '</small></small>',
      timer: 1500,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* referência para o painel adminitrativo  */
      if (result.dismiss === Swal.DismissReason.timer) {
        window.location = "painel-igreja"
        }
    })
  }     
      


/* Função para O Alerta de Loguin quanto ao fechamento do painel adm */
      function Exit(msg){
        let timerInterval
        Swal.fire({
          position: 'top-end',
          icon: 'info',
          title: '<small><small>'+ msg + '</small></small>',
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft()
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* referência para a tela de loguin  */
          if (result.dismiss === Swal.DismissReason.timer) {
            window.location ='index.php'
          }
        })
     }

    
        
