# 🚀 Automated Deployment Setup for swrice.com

## Overview
This repository now has automated deployment set up! When you merge changes from `dev` to `production`, they will automatically deploy to your server at swrice.com.

## 📋 Setup Instructions

### 1. Add SSH Public Key to Your Server
Copy this public key and add it to your server's authorized_keys:

```
ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIIEgFYOY5rILKDD5k9JlIj42/J8Em4Jt3yIC370ne5W7 github-actions-deploy@swrice.com
```

**Steps:**
1. SSH into your server: `ssh -p 65002 u965330696@46.202.138.12`
2. Run: `mkdir -p ~/.ssh && chmod 700 ~/.ssh`
3. Add the public key: `echo "ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIIEgFYOY5rILKDD5k9JlIj42/J8Em4Jt3yIC370ne5W7 github-actions-deploy@swrice.com" >> ~/.ssh/authorized_keys`
4. Set permissions: `chmod 600 ~/.ssh/authorized_keys`

### 2. Add GitHub Secrets
Go to your repository settings → Secrets and variables → Actions, and add these secrets:

| Secret Name | Value |
|-------------|-------|
| `SSH_PRIVATE_KEY` | The private key (see below) |
| `SSH_HOST` | `46.202.138.12` |
| `SSH_PORT` | `65002` |
| `SSH_USER` | `u965330696` |
| `DEPLOY_PATH` | `/path/to/your/wordpress/directory` ⚠️ **You need to specify this!** |

**Private Key to add as `SSH_PRIVATE_KEY` secret:**
```
-----BEGIN OPENSSH PRIVATE KEY-----
b3BlbnNzaC1rZXktdjEAAAAABG5vbmUAAAAEbm9uZQAAAAAAAAABAAAAMwAAAAtzc2gtZW
QyNTUxOQAAACCBIBWDmOayCygw+ZPSZSI+NvyfBJuCbd8iAt+9J3uVuwAAAKg6mXCJOplw
iQAAAAtzc2gtZWQyNTUxOQAAACCBIBWDmOayCygw+ZPSZSI+NvyfBJuCbd8iAt+9J3uVuw
AAAEAOoMVhQFmV99Yh9xLZbgYJWS82Ht7HevSlOHVxJnwHpYEgFYOY5rILKDD5k9JlIj42
/J8Em4Jt3yIC370ne5W7AAAAIGdpdGh1Yi1hY3Rpb25zLWRlcGxveUBzd3JpY2UuY29tAQ
IDBAUE=
-----END OPENSSH PRIVATE KEY-----
```

### 3. Find Your WordPress Directory Path
You need to determine where WordPress is installed on your server. Common paths:
- `/var/www/html`
- `/var/www/swrice.com`
- `/home/u965330696/public_html`
- `/home/u965330696/domains/swrice.com/public_html`

SSH into your server and find the correct path, then update the `DEPLOY_PATH` secret.

## 🔄 How It Works

### Workflow:
1. **Development**: Make changes in the `dev` branch
2. **Create PR**: Create a pull request from `dev` to `production`
3. **Review & Merge**: Review and merge the PR
4. **Auto Deploy**: GitHub Actions automatically deploys to swrice.com!

### What Gets Deployed:
- All WordPress files (wp-content, themes, plugins, etc.)
- Excludes: .git, .github, README.md, .gitignore
- Uses `rsync` with `--delete` flag (removes files not in repo)

## 🛠️ Manual Deployment
You can also trigger deployment manually:
1. Go to Actions tab in GitHub
2. Select "Deploy to Production Server"
3. Click "Run workflow"

## 🔧 Troubleshooting
- Check the Actions tab for deployment logs
- Ensure SSH key is properly added to server
- Verify all GitHub secrets are set correctly
- Make sure DEPLOY_PATH points to your WordPress directory

## 🎯 Next Steps
1. Add the SSH public key to your server
2. Set up all GitHub secrets (especially DEPLOY_PATH)
3. Test by creating a PR from dev to production!
