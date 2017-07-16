.PHONY: test test-integration

test:
	./vendor/bin/peridot test/go-to-billing.spec.php

test-integration:
	./vendor/bin/peridot test/integration/integration-tests.spec.php
