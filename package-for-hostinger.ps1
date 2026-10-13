# ==============================================================================
# Modern Jewellery House - Create Ready-to-Upload Hostinger ZIP
# ==============================================================================
Write-Host "📦 Creating Hostinger deployment ZIP package..." -ForegroundColor Cyan

$zipName = "hostinger-deploy.zip"
if (Test-Path $zipName) {
    Remove-Item $zipName -Force
}

# Directories and files to include
$includeItems = @(
    "app",
    "bootstrap",
    "config",
    "database",
    "public",
    "resources",
    "routes",
    "storage",
    "vendor",
    ".htaccess",
    ".env.example",
    "modern_jewellery_house.sql",
    "HOSTINGER_DEPLOYMENT.md"
)

Write-Host "Compressing files into $zipName (including vendor and public assets)..." -ForegroundColor Yellow
Compress-Archive -Path $includeItems -DestinationPath $zipName -Force

Write-Host "✅ $zipName created successfully!" -ForegroundColor Green
Write-Host "You can now directly upload and extract $zipName inside Hostinger's public_html folder." -ForegroundColor Green
