pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh '''# Build
oc login https://openshift-master.nosopenshifttest.os.nos.aws.npocloud.nl:8443 --token=itT5u4nkWW9E6ED-6OlgKe12b9Yg482ACYqPY2chjP0 --insecure-skip-tls-verify

export ENV=test

oc new-app -f ${template} -p APPLICATION_NAME=${ENV}-app -p NGINX_SERVICE_NAME=${ENV}-nginx -p PHPFPM_SERVICE_NAME=${ENV}-phpfpm -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=${github_repo} -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}


'''
        input 'Continue?'
        sh '''# Cleanup
export ENV=test

oc delete all -l app=${ENV}-app -n ${namespace}'''
      }
    }
    stage('stage') {
      steps {
        sh '''# Build
export ENV=staging

oc new-app -f ${template} -p APPLICATION_NAME=${ENV}-app -p NGINX_SERVICE_NAME=${ENV}-nginx -p PHPFPM_SERVICE_NAME=${ENV}-phpfpm -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=${github_repo} -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}


'''
        input 'Continue?'
        sh '''# Cleanup
export ENV=staging

oc delete all -l app=${ENV}-app -n ${namespace}'''
      }
    }
  }
  environment {
    namespace = 'test-20180324-2'
    template = 'test-template.yaml'
    github_repo = 'https://github.com/ferrymanders/demo-site.git'
  }
}