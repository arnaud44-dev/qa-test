---
# NOTICE: Copyright 2026 Talend SA, Talend, Inc., and affiliates. All Rights Reserved. Customer’s use of the software contained herein is subject to the terms and conditions of the Agreement between Customer and Talend.
layout: "apiDefinition_1.1.0"
api-definition:
  specVersion: "4.1.0"
  info:
    name: "aaa"
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
        "name" : "aaa 1.0.0",
        "description" : "No description",
        "importedFrom" : "99587202-bf4a-4ae3-96a6-56c29da77521"
      }
    } ],
    "environments" : [ {
      "name" : "aaa 1.0.0",
      "importedFrom" : {
        "projectId" : "99587202-bf4a-4ae3-96a6-56c29da77521"
      },
      "variables" : {
        "94e4cfa5-872e-43a3-92ff-69ba4043fed4" : {
          "name" : "BaseUrl",
          "value" : "https://example.com",
          "enabled" : true,
          "private" : false
        }
      }
    } ]
  }
---
