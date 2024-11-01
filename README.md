# AIDevs3 - Ag3nts

## Quick Start

1. **Fork and clone the repository:**
2. **Build and start the Docker containers:**
   ```
   make build
   make up
   ```

3. **Access the PHP container and install Symfony:**
   ```
   make bash
   composer create-project symfony/skeleton ./ 7.1.*
   ```

4. **Access the application:**
   Open your browser and navigate to `http://localhost:8080`

## AIDevs

See example command [App\AiDevs3\Prework\Test](src/src/AiDevs3/Prework/Test.php)
To run it execute:

```
make bash
bin/console ai:test
```

If you want to debug what is sent and what is received use `--vvv` parameter:
```
bin/console ai:test --vvv
```
