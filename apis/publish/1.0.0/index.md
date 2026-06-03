---
# NOTICE: Copyright 2026 Talend SA, Talend, Inc., and affiliates. All Rights Reserved. Customer’s use of the software contained herein is subject to the terms and conditions of the Agreement between Customer and Talend.
layout: "apiDefinition_1.1.0"
api-definition:
  specVersion: "4.1.0"
  info:
    name: "publish"
    version: "1.0.0"
    description: "No description"
    license: {}
    contact: {}
    termsOfService: ""
  contract:
    mediaTypes:
    - "application/json"
  components: {}
api-tryin: |-
  {
    "version" : 6,
    "entities" : [ {
      "entity" : {
        "type" : "Project",
        "name" : "publish 1.0.0",
        "description" : "No description",
        "importedFrom" : "f6482d14-84ec-42d8-898f-9d10b604f872"
      }
    } ],
    "environments" : [ {
      "name" : "publish 1.0.0",
      "importedFrom" : {
        "projectId" : "f6482d14-84ec-42d8-898f-9d10b604f872"
      },
      "variables" : {
        "e0e93c91-7c79-4ce4-8213-5951341456a8" : {
          "name" : "BaseUrl",
          "value" : "https://example.com",
          "enabled" : true,
          "private" : false
        }
      }
    } ]
  }
---
