pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh '''# OC Login
oc login ${oc_api} --token=${oc_token} --insecure-skip-tls-verify
'''
        sh '''# Build
export ENV=test
export TAG="${ENV}-${app}-$(date +%s)"

oc new-app -f ${template} -p APPLICATION_NAME=${ENV}-${app} -p IMG_TAG=${TAG} -p MYSQL_DB_SETUP=YES -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=${github_repo} -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}
oc start-build ${ENV}-${app}-nginx -n ${namespace}
oc start-build ${ENV}-${app}-phpfpm -n ${namespace}'''
        input 'Continue?'
        sh '''# Cleanup
export ENV=test

oc delete all -l app=${ENV}-${app} -n ${namespace}'''
      }
    }
    stage('stage') {
      steps {
        sh '''# Build
export ENV=staging
export TAG="${ENV}-${app}-$(date +%s)"

oc new-app -f ${template} -p APPLICATION_NAME=${ENV}-${app} -p IMG_TAG=${TAG} -p MYSQL_DB_SETUP=YES -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=${github_repo} -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}
oc start-build ${ENV}-${app}-nginx -n ${namespace}
oc start-build ${ENV}-${app}-phpfpm -n ${namespace}'''
        input 'Continue?'
        sh '''
# Cleanup
export ENV=staging
oc delete all -l app=${ENV}-${app} -n ${namespace}
'''
      }
    }
  }
  environment {
    app = 'testapp'
    oc_token = 'Hm_CNqc6LS7L1Z_phFa1k2ddhd4DIn0nagy8CdWQqwU'
    oc_api = 'https://openshift-master.nosopenshifttest.os.nos.aws.npocloud.nl:8443'
    namespace = 'test-20180325'
    template = 'templates/mysql-template.yaml'
    github_repo = 'https://github.com/ferrymanders/os-test.git'
  }
}