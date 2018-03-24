pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh '''oc login https://openshift-master.nosopenshifttest.os.nos.aws.npocloud.nl:8443 --token=itT5u4nkWW9E6ED-6OlgKe12b9Yg482ACYqPY2chjP0 --insecure-skip-tls-verify

export ENV=test

oc new-app -f app-template.yaml -p APPLICATION_NAME=${ENV}-app -p NGINX_SERVICE_NAME=${ENV}-nginx -p PHPFPM_SERVICE_NAME=${ENV}-phpfpm -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=https://github.com/ferrymanders/demo-site.git -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}


'''
        input 'Continue?'
      }
    }
    stage('stage') {
      steps {
        sh '''# cleanup
oc delete all -l app=test-app -n ${namespace}

export ENV=staging

oc new-app -f app-template.yaml -p APPLICATION_NAME=${ENV}-app -p NGINX_SERVICE_NAME=${ENV}-nginx -p PHPFPM_SERVICE_NAME=${ENV}-phpfpm -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=https://github.com/ferrymanders/demo-site.git -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}


'''
        input 'Continue?'
      }
    }
    stage('cleanup') {
      steps {
        sh 'oc delete all -l app=staging-app -n ${namespace}'
      }
    }
  }
  environment {
    namespace = 'test-20180324-2'
  }
}