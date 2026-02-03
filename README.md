# 🚀 Swrice.com - WordPress CI/CD Repository

This repository contains the WordPress customizations and automated deployment setup for **swrice.com**.

## 📁 Repository Structure

```
/swrice/
├── .github/
│   └── workflows/
│       └── deploy-production.yml    # Automated deployment workflow
├── .gitignore                       # Excludes WordPress core files
├── README.md                        # This file
├── DEPLOYMENT_SETUP.md             # Deployment configuration guide
└── wp-content/                     # WordPress customizations only
    ├── plugins/
    │   └── swrice-functionality/   # Custom plugin
    ├── themes/                     # Custom themes
    └── uploads/                    # Media files (ignored in git)
```

## 🔄 Workflow Process

### Development Workflow:
1. **Development**: Make changes in the `dev` branch
2. **Create PR**: Create a pull request from `dev` → `production`
3. **Review & Merge**: Review and merge the PR
4. **Auto Deploy**: GitHub Actions automatically deploys only changed files to swrice.com

### Branch Structure:
- **`dev`**: Development branch (allows direct pushes)
- **`production`**: Protected branch (PR-only, triggers deployment)

## 🛠️ What Gets Deployed

- ✅ **Only wp-content folder** (themes, plugins, customizations)
- ✅ **Only changed files** (efficient incremental sync)
- ❌ **WordPress core files** (managed on server, not in repo)

## 🔧 Key Features

- **Incremental Deployment**: Only changed files are uploaded
- **Branch Protection**: Production branch requires PR approval
- **WordPress Core Preservation**: Core files remain on server
- **Secure SSH**: Encrypted key-based authentication
- **Automated Process**: No manual file uploads needed

## 📋 Quick Commands

```bash
# Switch to dev branch
git checkout dev

# Make your changes
# ... edit files ...

# Commit changes
git add .
git commit -m "Your change description"

# Push to dev
git push origin dev

# Create PR from dev to production via GitHub UI
```

## 🌐 Live Site

**Production URL**: [swrice.com](https://swrice.com)

## 📚 Documentation

For detailed setup instructions, see [DEPLOYMENT_SETUP.md](DEPLOYMENT_SETUP.md).
