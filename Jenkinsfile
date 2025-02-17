pipeline {
  agent any
  stages {
//     stage('Debug Info') {
//       steps {
//         sh 'whoami;hostname;uptime'
//       }
//     }

//     stage('Build Docker Image') {
//       steps {
//         sh '''cd Backend;
// docker build . \\
// -f backend.dockerfile \\
// -t tumbler-backend-api'''
//       }
//     }

//     stage('Run Container') {
//       steps {
//         sh '''docker run \\
// --name tumbler-backend-api \\
// --entrypoint /bin/bash \\
// -dt --rm tumbler-backend-api'''
//       }
//     }

//     stage('Lint') {
//       steps {
//         sh 'docker exec tumbler-backend-api bash -c \'bash lint.sh\''
//       }
//     }

//     stage('Test') {
//       steps {
//         sh 'docker exec tumbler-backend-api bash -c \'bash test.sh\''
//       }
//     }

//     stage('Stop Container & Remove Image') {
//       steps {
//         sh 'docker container stop tumbler-backend-api'
//         sh 'docker image remove tumbler-backend-api'
//         sh 'docker system prune -f'
//       }
//     }

//     stage('List Docker Images & Containers') {
//       steps {
//         sh 'docker image ls -a'
//         sh 'docker container ls -a'
//       }
//     }

    stage('Deploy To dev-server') {
      agent {
        node {
          label 'dev-server'
        }
      }
      when {
        branch 'backendteam'
      }
      steps {
        sh 'whoami;hostname;uptime'
        sh '''cd Backend;
az storage file download --account-name tumblerstorageaccount -s tumbler-secrets -p backend.dev.env --dest .env;
az storage file download --account-name tumblerstorageaccount -s tumbler-secrets -p oauth-private.dev.key --dest storage/oauth-private.key;
az storage file download --account-name tumblerstorageaccount -s tumbler-secrets -p oauth-public.dev.key --dest storage/oauth-public.key;
docker-compose up -d --build;
#docker system prune -f;'''
      }
      post {
        always {
          discordSend(
            title: JOB_NAME,
            link: env.BUILD_URL,
            description: "${JOB_NAME} DEV Deployment Status: ${currentBuild.currentResult}",
            result: currentBuild.currentResult,
            thumbnail: 'https://i.dlpng.com/static/png/6378770_preview.png',
            webhookURL: 'https://discord.com/api/webhooks/921772869782994994/mi4skhArIoT6heXWebPiWLn6Xc95rZgUqtW7qriBOYvnl0sTdfn16we7yPY-n-DJYRmH'
          )
        }
      }
    }
    stage('Deploy To Production') {
      agent {
        node {
          label 'prod-server'
        }
      }
      when {
        branch 'main'
      }
      steps {
        sh 'whoami;hostname;uptime'
        sh '''cd Backend;
az storage file download --account-name tumblerstorageaccount -s tumbler-secrets -p backend.env --dest .env;
az storage file download --account-name tumblerstorageaccount -s tumbler-secrets -p oauth-private.key --dest storage/oauth-private.key;
az storage file download --account-name tumblerstorageaccount -s tumbler-secrets -p oauth-public.key --dest storage/oauth-public.key;
docker-compose up -d --build;'''
      }
      post {
        always {
          discordSend(
            title: JOB_NAME,
            link: env.BUILD_URL,
            description: "${JOB_NAME} PROD Deployment Status: ${currentBuild.currentResult}",
            result: currentBuild.currentResult,
            thumbnail: 'https://i.dlpng.com/static/png/6378770_preview.png',
            webhookURL: 'https://discord.com/api/webhooks/921772869782994994/mi4skhArIoT6heXWebPiWLn6Xc95rZgUqtW7qriBOYvnl0sTdfn16we7yPY-n-DJYRmH'
          )
        }
      }
    }
  }

  post {
    unsuccessful {
      sh 'docker container stop tumbler-backend-api || true'
      sh 'docker image remove tumbler-backend-api || true'
      sh 'docker system prune -f'
    }

    cleanup {
      cleanWs()
    }
  }
}
